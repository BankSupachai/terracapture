<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Stacked form</h2>
  <form action={{url("api/appointment")}} method="POST">
    <div class="row">
        <div class="col-4">
            <label for="email">Day</label>
            <input type="number" class="form-control" id="day"  name="day">
        </div>
        <div class="col-4">
            <label for="email">Date</label>
            <input type="date" class="form-control" id="date"  name="date">
        </div>

        <div class="col-4">
            <label for="email">Hn</label>
            <input type="text" class="form-control" id="hn"  name="hn">
        </div>
        <div class="col-4">
            <label for="email">Name</label>
            <input type="text" class="form-control" id="name"  name="name">
        </div>
        <div class="col-4">
            <label for="email">Physician</label>
            <input type="text" class="form-control" id="doctor"  name="doctor">
        </div>
        <div class="col-4">
            <label for="email">procedure</label>

           <select class="form-select" name="" id="">
            @foreach ($procedure as $data)
            <option value="{{$data['code']}}">{{$data['name']}}</option>
            @endforeach
        </select>
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
