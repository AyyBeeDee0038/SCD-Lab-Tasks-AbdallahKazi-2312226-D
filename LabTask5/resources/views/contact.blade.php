@extends('layouts.app')


@section('title','Contact — GameHub')


@section('content')
<h2>Contact Us</h2>
<p>If this were a real site you'd be able to send a message. For this assignment we only need the frontend, so here's a static contact form.</p>


<div class="row">
<div class="col-md-8">
<form>
<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" class="form-control" placeholder="Your name">
</div>
<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" class="form-control" placeholder="you@example.com">
</div>
<div class="mb-3">
<label class="form-label">Message</label>
<textarea class="form-control" rows="5" placeholder="Your message"></textarea>
</div>
<button type="button" class="btn btn-primary">Send Message</button>
</form>
</div>
</div>
@endsection