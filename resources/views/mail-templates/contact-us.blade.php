<h2>Hello Admin,</h2>
<p>You received an email from : {{ $name }}</p>
<p>Here are the details:</p>
<div class="card-body">
    <div class="subject">
        <h4>Subject</h4>
        <div class="subject-div">
            <h3>{{ $subject }}</h3>
        </div>
    </div>
    <div class="name">
        <h4>Name</h4>
        <div class="name-div">
            <h3>{{ $name }}</h3>
        </div>
    </div>
    <div class="email">
        <h4>Email Address</h4>
        <div class="email-div">
            <h3>{{ $email }}</h3>
        </div>
    </div>
    <div class="phone">
        <h4>Phone Number</h4>
        <div class="phone-div">
            <h3>{{ $phone_number }}</h3>
        </div>
    </div>
    <div class="message">
        <h4>Message</h4>
        <div class="message-div">
            <h6>{{ $msg }}</h6>
        </div>
    </div>
</div>