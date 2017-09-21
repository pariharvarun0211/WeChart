@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="padding-bottom: 0;padding-top: 0">
          <h3 >Edit Profile</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ url('/EditProfile') }}">
            <div class="form-group">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>
              <div class="col-md-6">

                <input id="email" type="email" class="form-control" name="email" value="<?php echo ($user['email']); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="role" class="col-md-4 control-label">Role</label>
              <div class="col-md-6">

                <input id="role" type="role" class="form-control" name="role" value="<?php echo ($user['role']); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="departmentName" class="col-md-4 control-label">Department</label>
              <div class="col-md-6">

                <input id="role" type="departmentName" class="form-control" name="role" value="<?php echo ($user['departmentName']); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="firstname" class="col-md-4 control-label">First Name</label>
              <div class="col-md-6">

                <input id="firstname" type="firstname" class="form-control" name="firstname" value="<?php echo ($user['firstname']); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-md-4 control-label">Last Name</label>
              <div class="col-md-6">

                <input id="lastname" type="lastname" class="form-control" name="lastname" value="<?php echo ($user['lastname']); ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="contactno" class="col-md-4 control-label">Contact No.</label>
              <div class="col-md-6">

                <input id="contactno" type="contactno" class="form-control" name="contactno" value="<?php echo ($user['contactno']); ?>">
              </div>
            </div>
            <hr>
            <h4> Security Questions </h4>
            <hr>
            <div class="form-group">
              <label for="security_question1_Id" class="col-md-4 control-label">Security Question 1</label>
              <div class="col-md-6">

                <input id="security_question1_Id" type="security_question1_Id" class="form-control" name="security_question1_Id" value="<?php echo ($security_question1); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="security_answer1" class="col-md-4 control-label">Security Answer 1</label>
              <div class="col-md-6">

                <input id="security_answer1" type="security_answer1" class="form-control" name="security_answer1" value="<?php echo ($user['security_answer1']); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="security_question2_Id" class="col-md-4 control-label">Security Question 2</label>
              <div class="col-md-6">

                <input id="security_question2_Id" type="security_question2_Id" class="form-control" name="security_question2_Id" value="<?php echo ($security_question2); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="security_answer2" class="col-md-4 control-label">Security Answer 2</label>
              <div class="col-md-6">

                <input id="security_answer2" type="security_answer2" class="form-control" name="security_answer2" value="<?php echo ($user['security_answer2']); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="security_question3_Id" class="col-md-4 control-label">Security Question 3</label>
              <div class="col-md-6">

                <input id="security_question3_Id" type="security_question3_Id" class="form-control" name="security_question3_Id" value="<?php echo ($security_question3); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="security_answer3" class="col-md-4 control-label">Security Answer 3</label>
              <div class="col-md-6">

                <input id="security_answer3" type="security_answer3" class="form-control" name="security_answer3" value="<?php echo ($user['security_answer3']); ?>" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                          Save Changes
                </button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  @endsection
