@extends('Fronted.layouts.master')@section('title')    {{trans('main.contracts')}}@endsection@section('content')    <section id="content">        <div id="content-wrap">            <section class="page-header content-header page-header-xs">                <div class="container">                    <!-- breadcrumbs -->                    <ul id="breadcrumbs">                        <li><a href="/">{{trans('main.home')}}</a></li>                        <li>{{trans('main.contracts')}}</li>                    </ul>                </div>            </section>            <div class="section-content sm-pd">                <div class="container">                    <div class="row">                        <div class="col-md-6 col-md-offset-3">                            <div class="section-title ">                                <img src="/Fronted/images/content-img/about.png" alt="" />                            </div>                        </div>                    </div>                    <div class="row">                        <div class="col-md-8 col-md-offset-2 cust-pd-rt cust-div-display">                            <div class="section-title text-center  title-right" style="padding:0">                                <h2 class="contract-title job_title">   العقود </h2>                                <div style="margin-top:43px;" class="wow animated fadeInRightBig" data-wow-delay="0.8s">                                    <form id="add-form">                                        <div class="col-md-4 col-xs-12 col-lg-4">                                            <div class="form-group">                                                <label for="country">نوع العقد </label>                                                <select class="form-control search-slt" id="country">                                                    <option>1</option>                                                    <option> 2</option>                                                </select>                                            </div>                                        </div>                                        <div class="col-md-4 col-xs-12 col-lg-4">                                            <div class="form-group">                                                <label for="InputName"> الأسم </label>                                                <input class="form-control" id="InputName" placeholder=""                                                       type="text">                                            </div>                                        </div>                                        <div class="col-md-4 col-xs-12 col-lg-4">                                            <div class="form-group">                                                <label for="InputEMail"> البريد الألكتروني</label>                                                <input type="text" name="InputEMail" id="InputEMail" class="form-control" placeholder=" ">                                            </div>                                        </div>                                        <div class="col-md-6 col-xs-12 col-lg-6">                                            <div class="form-group">                                                <label for="Inputtel">رقم الهاتف</label>                                                <input class="form-control" id="Inputtel" placeholder=""                                                       type="tel">                                            </div>                                        </div>                                        <div class="col-md-6 col-xs-12 col-lg-6">                                            <div class="form-group">                                                <label for="InputAddress"> العنوان </label>                                                <input class="form-control" id="InputAddress" placeholder=""                                                       type="text">                                            </div>                                        </div>                                        <div class="col-md-12 col-xs-12 col-lg-12">                                            <div class="form-group">                                                <label for="inputmessage">  الرسالة </label>                                                <textarea name="inputmessage" rows="2" id="inputmessage" class="form-control" placeholder=""></textarea>                                            </div>                                        </div>                                        <div class="col-md-12 col-xs-12 col-lg-12">                                            <div class="form-group">                                                <button class="form-control btn-job" type="submit">  ارسال</button>                                            </div>                                        </div>                                        <!-- .form-group end -->                                    </form>                                </div><!-- .section-title end -->                            </div>                        </div>                    </div>                </div>            </div>            <div class="wrapper">                <div class="container">                    <div class="row">                        <div class="col-md-8 col-md-offset-4 stepper">                        </div>                    </div>                </div>            </div>        </div><!-- #content-wrap -->    </section><!-- #content end -->@endsection