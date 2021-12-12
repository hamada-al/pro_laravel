
    <div class="form-group">
        <label for="name" >Name</label>
        <input name="name" value="{{$model->name??''}}" required>
    </div>
    <div class="form-group">
        <label >E-mail</label>
        <input name="email" value="{{$model->email??''}}" >
    </div>
    <div class="form-group">
        <label >Type</label>
        <select name="type">
            <option value="1" {{$model->type==1?'selected':''}}>Mart</option>
            <option value="2" {{$model->type==2?'selected':''}}>Customer</option>
            <option value="3" {{$model->type==3?'selected':''}}>Admin</option>
        </select>
    </div>
    @if($edit ==0 )
    <div class="form-group">
        <label >Password</label>
        <input name="password" type="password" value="{{$model->password??''}}" >
    </div>
    <div class="form-group">
        <label >Image</label>
        <input class="form-control"  type="file" name="image" required>
    </div>
    @endif
    <div class="form-group">
        <input name="user_id" type="hidden" value="{{auth()->user()->id}}">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
