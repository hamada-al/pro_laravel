
    <div class="form-group">
        <label for="name" >Name</label>
        <input name="name" value="{{$model->name??''}}" required>
    </div>
    <div class="form-group">
        <label >Price</label>
        <input name="price" value="{{$model->price??''}}" >
    </div>
    @if($edit ==0 )
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
