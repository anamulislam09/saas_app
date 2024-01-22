<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />

<form action="{{ route('update.user') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="modal-body">
        <div class="mb-3 mt-3">
            <label for="user_name" class="form-label"> User Name:</label>
            <input type="text" class="form-control" value="{{ $data->name }}" name="name">
        </div>

        <div class="mb-3 mt-3">
            <label for="flat_no" class="form-label"> Flat no:</label>
            <input type="text" class="form-control" value="{{ $data->flat_no }}" name="flat_no">
        </div>

        <div class="mb-3 mt-3">
            <label for="user_phone" class="form-label"> User phone:</label>
            <input type="text" class="form-control" value="{{ $data->phone }}" name="phone">
        </div>

        <div class="mb-3 mt-3">
            <label for="user_email" class="form-label"> User email:</label>
            <input type="text" class="form-control" value="{{ $data->email }}" name="email">
        </div>

        <div class="mb-3 mt-3">
            <h6> Status</h6>
            <input type="checkbox" name="status" value="1"  @if ( $data->status ==1) checked @endif data-bootstrap-switch
                data-off-color="danger" data-on-color="success">
        </div>

        {{-- <div class="mb-3 mt-3">
            <label for="exampleInputEmail1"> Role  </label>
            <select name="role_id" id="" class="form-control">
                <option value="" selected disabled>Selecte once</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        @if ($role->id == $data->role_id) selected @endif>
                        {{ $role->name }}</option>
                @endforeach
            </select>
        </div> --}}

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>
<script>
    $('.dropify').dropify()
</script>

{{-- CHECKBOX  --}}
<script>
    $('.dropify').dropify(); //dropify image 
    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>