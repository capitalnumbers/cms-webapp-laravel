@extends('layouts.admin')
@section('content')

 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Form advanced</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <!-- form input mask -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>General Settings</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    {{ Form::open(['url' => 'settings', 'class'=>'form-horizontal form-label-left']) }}
                        <div class="form-group">
                          {{Form::label('footerText', 'Footer Text', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {{Form::textarea('footerText', $footerText or '', ['class'=>'form-control col-md-7 col-xs-12'])}}
                          </div>
                        </div>
                        <input type="hidden" name="frm_type" value="general" >
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div>

                    {{ Form::close() }}
                  </div>
                </div>
              </div>
              <!-- /form input mask -->

              <!-- form color picker -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>other Settings <small>(Comma Separated drop down data)</small></h2>
                    <div class="clearfix"></div>
                    @if(Session::has('other-success'))
                      <div class="alert alert-success">
                        <strong>Success!</strong> {{ Session::get('other-success') }}
                      </div>
                    @endif
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    {{ Form::open(['url' => 'settings', 'class'=>'form-horizontal form-label-left']) }}
                        <div class="form-group">
                          {{Form::label('gender', 'Gender', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {{Form::text('gender', '', ['class'=>'form-control col-md-7 col-xs-12'])}}
                          </div>
                        </div>
                        <div class="form-group">
                          {{Form::label('ageGroup', 'Age Group', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {{Form::text('ageGroup', '', ['class'=>'form-control col-md-7 col-xs-12'])}}
                          </div>
                        </div>
                        <div class="form-group">
                          {{Form::label('ethnicity', 'Ethnicity', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {{Form::textArea('ethnicity', '', ['class'=>'form-control col-md-7 col-xs-12'])}}
                          </div>
                        </div>
                        <div class="form-group">
                          {{Form::label('maritalStatus', 'Marital Status', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {{Form::textArea('maritalStatus', '', ['class'=>'form-control col-md-7 col-xs-12'])}}
                          </div>
                        </div>
                        <div class="form-group">
                          {{Form::label('educationLevel', 'Education Level', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {{Form::textArea('educationLevel', '', ['class'=>'form-control col-md-7 col-xs-12'])}}
                          </div>
                        </div>
                      <input type="hidden" name="frm_type" value="other" >
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    {{ Form::close() }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Social Media Settings  <small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    
                  </div>
                </div>
              </div>
          </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function(){
    $(".alert").fadeOut(5000);
  })
  </script>
@stop