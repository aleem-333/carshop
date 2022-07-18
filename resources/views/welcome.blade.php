<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>CarShop</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="/">CarShop</a>
        </div>
      </nav>
    </header>
    <div class="container">
        <h1 class="pt-3">Cars</h1>
        <div class="mb-3">
          <form action="/" class="row justify-content-end">
            <div class="form-group col-3">
              <label for="order_by" class="col-form-label">Order by</label>
              <select class="form-control" id="order_by">
                <option value="">Select</option>
                <!-- display all columns name from $cars -->
                @foreach ($columnNames as $column)
                  <option value="{{ $column }}" @if ($column == request()->order_by) selected @endif>{{ ucfirst($column) }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-3">
              <label for="car_type" class="col-form-label">Car Type</label>
              <select class="form-control" id="car_type">
                <option value="">Select</option>
                <option value="new" @if ('new' == request()->car_type) selected @endif>New</option>
                <option value="used" @if ('used' == request()->car_type) selected @endif>Used</option>
              </select>
            </div>

          </form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Condition</th>
                    <th>Price</th>
                    <th>Seller</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->make }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->year }}</td>
                        <td>
                            @if ($car->condition == 'new')
                                <span class="badge bg-info">{{ ucfirst($car->condition) }}</span>
                            @else
                                <span class="badge bg-dark">{{ ucfirst($car->condition) }}</span>
                            @endif
                        </td>
                        <td class="font-weight-bold">${{ $car->price }}</td>
                        <td>{{ $car->seller }}</td>
                        <td>
                          @if ($car->status == 'for sale')
                            <span class="badge bg-success">{{ ucwords($car->status) }}</span>
                          @elseif ($car->status == 'sold')
                            <span class="badge bg-danger">{{ ucwords($car->status) }}</span>
                          @elseif ($car->status == 'pending')
                            <span class="badge bg-warning">{{ ucwords($car->status) }}</span>
                          @endif
                        </td>
                        <td>{{ $car->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$cars->appends(request()->all())->links('pagination::bootstrap-5')}}
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script>
    $("#order_by, #car_type").change(function() {
      var order_by = $("#order_by").val();
      var car_type = $("#car_type").val();
      var url = "/?order_by=" + order_by + "&car_type=" + car_type;
      window.location.href = url;
    });
  </script>

</html>
