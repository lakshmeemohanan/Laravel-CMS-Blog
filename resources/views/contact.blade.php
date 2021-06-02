@extends('components.home-master')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-user">
          <div class="card-header">
            <h5 class="card-title">Contact Us</h5>
          </div>
          <div class="card-body">
            @if(Session::has('contact-submitted'))
              <div class="alert alert-success">{{Session::get('contact-submitted')}}</div>
            @endif
            <form method="POST" action="{{ route('contact.store') }}"> 
            @csrf
              <div class="form-group">
                  <label><strong>Name<span class="mandatory">*</span></strong></label>
                  <input type="text" name="name" class="form-control" placeholder="Name">
                  @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
              </div>
              <div class="form-group">
                  <label><strong>Email ID<span class="mandatory">*</span></strong></label>
                  <input type="text" name="email" class="form-control" placeholder="Email ID">
                  @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
              <div class="form-group">
                  <label><strong>Phone Number<span class="mandatory">*</span></strong></label>
                  <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
                  @if ($errors->has('phone_number'))
                      <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                  @endif
              </div>
              <div class="form-group">
                  <label><strong>Subject<span class="mandatory">*</span></strong></label>
                  <input type="text" name="subject" class="form-control" placeholder="Subject">
                  @if ($errors->has('subject'))
                      <span class="text-danger">{{ $errors->first('subject') }}</span>
                  @endif
              </div>
              <div class="form-group">
                  <label><strong>Message<span class="mandatory">*</span></strong></label>
                  <textarea name="message" class="form-control" placeholder="Message"></textarea>
                  @if ($errors->has('message'))
                      <span class="text-danger">{{ $errors->first('message') }}</span>
                  @endif
              </div>
              <div class="form-group">
                  <button class="btn btn-secondary btn-submit">Submit</button>
              </div>
            </form>
          </div>
       </div>
     </div>
   </div>
</div>
@endsection
     