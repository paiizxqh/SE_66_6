@section('title', 'หน้าแรก')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">หน้าแรก</h2>
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    </x-slot>

    <body>
        <div class="container">
            <div class="py-12">
                <div class="page-content container note-has-grid">
                    <div class="tab-content bg-transparent">
                        <div id="note-full-container" class="note-has-grid row">
                            <div class="col-md-4 single-note-item all-category" style="">
                                <div class="card card-body">
                                    <span class="side-stick"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0"
                                        data-noteheading="Book a Ticket for Movie">Developer <i
                                            class="point fa fa-circle ml-1 font-10"></i></h5>
                                    <p class="note-date font-12 text-muted">สามารถเห็นข้อมูลได้ทุกหน้า</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted"
                                            data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">
                                            Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-1"><i class="fa fa-star favourite-note"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-category note-lightblue" style="">
                                <div class="card card-body">
                                    <span class="side-stick"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0"
                                        data-noteheading="Book a Ticket for Movie">Admin<i
                                            class="point fa fa-circle ml-1 font-10"></i></h5>
                                    <p class="note-date font-12 text-muted">สามารถเห็นข้อมูลได้ทุกหน้า</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted"
                                            data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">
                                            Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-1"><i class="fa fa-star favourite-note"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-category note-lightyellow" style="">
                                <div class="card card-body">
                                    <span class="side-stick"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0"
                                        data-noteheading="Book a Ticket for Movie">Manager<i
                                            class="point fa fa-circle ml-1 font-10"></i></h5>
                                    <p class="note-date font-12 text-muted">สามารถเห็นข้อมูลได้ทุกหน้า</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted"
                                            data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">
                                            Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-1"><i class="fa fa-star favourite-note"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-category note-lightgreen" style="">
                                <div class="card card-body">
                                    <span class="side-stick"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0"
                                        data-noteheading="Book a Ticket for Movie">Sales<i
                                            class="point fa fa-circle ml-1 font-10"></i></h5>
                                    <p class="note-date font-12 text-muted">สามารถเห็นข้อมูลได้ทุกหน้า</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted"
                                            data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">
                                            Blandit tempus porttitor aasfs. Integer posuere erat a ante
                                            venenatis.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-1"><i class="fa fa-star favourite-note"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-category note-important" style="">
                                <div class="card card-body">
                                    <span class="side-stick"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0"
                                        data-noteheading="Book a Ticket for Movie">Assistant<i
                                            class="point fa fa-circle ml-1 font-10"></i></h5>
                                    <p class="note-date font-12 text-muted">สามารถเห็นข้อมูลได้ทุกหน้า</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted"
                                            data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">
                                            Blandit tempus porttitor aasfs. Integer posuere erat a ante
                                            venenatis.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-1"><i class="fa fa-star favourite-note"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-category note-important" style="">
                                <div class="card card-body">
                                    <span class="side-stick"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0"
                                        data-noteheading="Book a Ticket for Movie">Surveyor<i
                                            class="point fa fa-circle ml-1 font-10"></i></h5>
                                    <p class="note-date font-12 text-muted">สามารถเห็นข้อมูลได้ทุกหน้า</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted"
                                            data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">
                                            Blandit tempus porttitor aasfs. Integer posuere erat a ante
                                            venenatis.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-1"><i class="fa fa-star favourite-note"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-category note-important" style="">
                                <div class="card card-body">
                                    <span class="side-stick"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0"
                                        data-noteheading="Book a Ticket for Movie">Academician<i
                                            class="point fa fa-circle ml-1 font-10"></i></h5>
                                    <p class="note-date font-12 text-muted">สามารถเห็นข้อมูลได้ทุกหน้า</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted"
                                            data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">
                                            Blandit tempus porttitor aasfs. Integer posuere erat a ante
                                            venenatis.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-1"><i class="fa fa-star favourite-note"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
