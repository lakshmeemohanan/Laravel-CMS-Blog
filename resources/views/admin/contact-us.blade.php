@extends('components.admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary">Contact Us</h2>
                    @if(Session::has('contact-deleted'))
                        <div class="alert alert-success">{{Session::get('contact-deleted')}}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    @if($contacts->count() > 0)
                        <table class="table table-bordered" id="contact-us-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Phone Number</th>
                                <th>Sent On</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Phone Number</th>
                                <th>Sent On</th>
                                <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->subject}}</td>
                                    <td>{{$contact->message}}</td>
                                    <td>{{$contact->phone_number}}</td>
                                    <td>{{$contact->created_at->diffForhumans()}}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.contact.destroy', $contact->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="Delete" />
                                        </form>
                                    </td>                                    
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                        @else 
                            <p class="alert alert-danger">No Records Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    <div>
@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/datatables.js')}}"></script>
@endsection