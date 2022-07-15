@include('frontend.includes.header')
<style type="text/css">
    .remove_img
    {
        cursor: pointer;
        background:red;
        color: #fff;
        padding: 5px;
    }
    textarea{
        height: auto!important;
    }
</style>

<div class="breadcrumb-area bg-overlay-2" style="background-image:url('{{ asset('') }}assets/frontend/images/breadcrumb.jpg')">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="section-title text-center">
                <h2 class="page-title">My Properties</h2>
                <ul class="page-list">
                    <li><a href="index.html">Home</a></li>
                    <li> My Properties</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="add-property-area pd-top-120 body-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="myproperties" class="table table-striped display dataTable no-footer">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Property Category</th>
                            <th>Property Details</th>
                            <th>Rent & Fees</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     @forelse ($property as $key =>  $element)
                    <tr>
                       
                        <td>{{$key+1}}</td>
                        <td><img src="{{ asset($element->image->image)}}" width="50"></td>
                        <td>{{ $element->property_heading }}</td>
                        <td>
                            <p><b>Address</b> :{{ $element->address }}</p>
                            <p><b>State</b> :{{ $element->state }}</p>
                            <p><b>City</b> :{{ $element->city }}</p>
                            <p><b>Zip</b> :{{ $element->zip }}</p>
                        </td>
                        <td>{{ $element->property_category->title }} </td>
                        <td>
                            <p><b>Is Furnished</b> :{{ ($element->furnished) ? 'Yes' : 'No' }}</p>
                            <p><b>Utilities Included</b> :{{ ($element->utilities) ? 'Yes' : 'No' }}</p>
                            <p><b>Bedrooms </b>:{{ $element->bedrooms }}</p>
                            <p><b>Bathrooms </b>:{{ $element->bathrooms }}</p> 
                        </td>
                        <td>
                            <p>Monthly Rent : ${{ $element->monthly_rent }}</p>
                            {!! ($element->fee_1) ? '<p> <b>'.$element->fee_1->name.'</b> : $'.$element->fee_1_amount.'</p>' : '' !!}
                            {!! ($element->fee_2) ? '<p> <b>'.$element->fee_2->name.'</b>: $'.$element->fee_2_amount.'</p>' : '' !!}
                            {!! ($element->fee_3) ? '<p> <b>'.$element->fee_3->name.'</b> : $'.$element->fee_3_amount.'</p>' : '' !!}
                        </td>
                        <td>
                            <a href="{{ route('user.edit-property',[$element->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                            <button onclick="deleteProperty({{ $element->id }})" class="btn btn-sm btn-danger">Delete</button>
                            @if ($element->status == 1)
                                <button onclick="changeStatus({{ $element->id }} , 0)" class="btn btn-sm btn-danger">Disable</button>
                            @else
                                <button onclick="changeStatus({{ $element->id }} , 1)" class="btn btn-sm btn-success">Enable</button>
                            @endif
                            
                            
                        </td>
                       
                        
                    </tr>
                    @empty
                            {{-- empty expr --}}
                    @endforelse
                </table>
            </div>
        </div>
        
    </div>
</div>
    
@include('frontend.includes.footer')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
{{-- Images Upload Script====================================================== --}}

  <script type="text/javascript"> 
    function deleteProperty(id) {
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            
                form_data = new FormData();
                form_data.append('_token', '{{ csrf_token() }}');
                
                form_data.append('id', id);
                $.ajax({
                    url: "{{ route('user.property.delete') }}",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $.blockUI();
                    },
                    success: function (data) {
                       $.unblockUI();
                        Swal.fire(
                          'Deleted!',
                          'Your Property has been deleted.',
                          'success'
                        )
                        location.reload();
                    }
                    
                  });
            }
           
          
        })
    }
    function changeStatus (id , status) 
    {
        form_data = new FormData();
        form_data.append('_token', '{{ csrf_token() }}');
        
        form_data.append('id', id);
        form_data.append('status', status);
        $.ajax({
            url: "{{ route('user.property.changeStatus') }}",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $.blockUI();
            },
            success: function (data) {
               $.unblockUI();
                Swal.fire(
                  'Changed!',
                  'Your Property Status has been Changed.',
                  'success'
                )
                location.reload();
            }
            
          });
    }
  $(document).ready( function () {
    $('#myproperties').DataTable()
} );
  
</script>