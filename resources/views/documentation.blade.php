@extends ('layouts.dashboard')

@section ('page_heading','Documentation')

@section('section')

    @component('widgets.panel')
        @slot('panelTitle', 'Default title')
        @slot ('panelBody')
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        @endslot
        @slot ('panelFooter')
<pre class="codeWrapper">
    <i class="fa fa-at"></i>section ('inside_panel_title', 'Default title')
    <i class="fa fa-at"></i>section ('inside_panel_body')
    &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/p&gt;
    <i class="fa fa-at"></i>endsection
    <i class="fa fa-at"></i>include('widgets.panel', array('header'=>true, 'as'=>'inside'))
</pre>
        @endslot
    @endcomponent

    @component('widgets.panel')
        @slot('panelTitle', 'Collapssible')
        @slot ('panelBody')
            @include('widgets.collapse', array('id'=>'2', 'header'=> 'This is a header', 'body'=>'Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.'))
        @endslot
        @slot ('panelFooter')
<pre class="codeWrapper">
    <i class="fa fa-at"></i>include('widgets.collapse', array('id'=>'2', 'header'=> 'This is a header', 'body'=>'Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.'))
</pre>
        @endslot
    @endcomponent

    @component('widgets.panel')
        @slot('panelTitle', 'Buttons')
        @slot ('panelBody')
            @include('widgets.button', array('value'=>'Info button', 'class'=>'info'))
            @include('widgets.button', array('class'=>'danger', 'size'=>'lg', 'value'=>'Large Button'))
            @include('widgets.button', array('class'=>'success btn-outline', 'value'=>'Primary'))
        @endslot
        @slot ('panelFooter')
<pre class="codeWrapper">
    <i class="fa fa-at"></i>include('widgets.button', array('value'=>'Info button', 'class'=>'info'))
    <i class="fa fa-at"></i>include('widgets.button', array('class'=>'danger', 'size'=>'lg', 'value'=>'Large Button'))
    <i class="fa fa-at"></i>include('widgets.button', array('class'=>'success btn-outline', 'value'=>'Primary'))
</pre>
        @endslot
    @endcomponent

    @component('widgets.panel')
        @slot('panelTitle', 'Buttons')
        @slot ('panelBody')
            @include('widgets.alert', array('class'=>'success', 'message'=> 'You have an alert', 'icon'=> 'user'))
            @include('widgets.alert', array('class'=>'info', 'dismissable'=>true, 'message'=> 'My message'))
        @endslot
        @slot ('panelFooter')
<pre class="codeWrapper">
    <i class="fa fa-at"></i>include('widgets.alert', array('class'=>'success', 'message'=> 'You have an alert', 'icon'=> 'user'))
    <i class="fa fa-at"></i>include('widgets.alert', array('class'=>'info', 'dismissable'=>true, 'message'=> 'My message'))
</pre>
        @endslot
    @endcomponent



    @component('widgets.panel')
        @slot('panelTitle', 'Progressbars')
        @slot ('panelBody')
            @include('widgets.progress', array('class'=> 'success', 'value'=>'44'))
            @include('widgets.progress', array('animated'=> true, 'value'=>'72'))
            @include('widgets.progress', array('class'=> 'danger', 'value'=>'12', 'badge'=>true))
        @endslot
        @slot ('panelFooter')
<pre class="codeWrapper">
    <i class="fa fa-at"></i>include('widgets.progress', array('class'=> 'success', 'value'=>'44'))
    <i class="fa fa-at"></i>include('widgets.progress', array('animated'=> true, 'value'=>'72'))
    <i class="fa fa-at"></i>include('widgets.progress', array('class'=> 'danger', 'value'=>'12', 'badge'=>true))
</pre>
        @endslot
    @endcomponent

@endsection
