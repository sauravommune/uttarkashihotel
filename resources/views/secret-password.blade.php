@error('password')
    {{$message}}
@enderror

<form method="post" action="{{route('secret.page.unlock')}}" >
@csrf
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name ="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>