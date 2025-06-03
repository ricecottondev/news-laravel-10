

        <script>var hostUrl = "{{url('template')}}/assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{url('template')}}/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{url('template')}}/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
        <!--begin::Vendors Javascript(used for this page only)-->
        				<script src="{{url('template')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <!--end::Vendors Javascript-->
        <!--begin::Custom Javascript(used for this page only)-->
						{{-- <script src="{{url('template')}}/assets/js/custom/apps/customers/list/export.js"></script>
						<script src="{{url('template')}}/assets/js/custom/apps/customers/list/list.js"></script>
						<script src="{{url('template')}}/assets/js/custom/apps/customers/add.js"></script> --}}
        <script src="{{url('template')}}/assets/js/widgets.bundle.js"></script>
        <script src="{{url('template')}}/assets/js/custom/widgets.js"></script>
        <script src="{{url('template')}}/assets/js/custom/apps/chat/chat.js"></script>
        <script src="{{url('template')}}/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
        <script src="{{url('template')}}/assets/js/custom/utilities/modals/create-app.js"></script>
        <script src="{{url('template')}}/assets/js/custom/utilities/modals/users-search.js"></script>
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="{{url('template')}}/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<script src="{{url('template')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{url('template')}}/assets/js/widgets.bundle.js"></script>
		<script src="{{url('template')}}/assets/js/custom/widgets.js"></script>
		<script src="{{url('template')}}/assets/js/custom/apps/chat/chat.js"></script>
		{{-- <script src="{{url('template')}}/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="{{url('template')}}/assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="{{url('template')}}/assets/js/custom/utilities/modals/new-target.js"></script>
		<script src="{{url('template')}}/assets/js/custom/utilities/modals/users-search.js"></script> --}}

		<!--end::Custom Javascript-->


    	<script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    	<script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    	<script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ url('') }}/parentchild/jquery.nestable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@stack('scripts')
<script>


$(document).ready(function()
{

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
            console.log(JSON.stringify(output[0].value));
            var valmenu = JSON.stringify(output[0].value);
            sendmenu(valmenu);
    };

    console.log("start");
    console.log(updateOutput);
    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);

    // activate Nestable for list 2
    // $('#nestable2').nestable({
    //     group: 1
    // })
    // .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    //updateOutput($('#nestable2').data('output', $('#nestable2-output')));



    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

    $('#nestable3').nestable();




});

function sendmenu(valmenu)
    {
        console.log((valmenu));
        updatemenu(valmenu);

    }

    function updatemenu(menu)
    {
        $.ajax({
                url: 'api/updateSetting_menu',
                method: 'POST',
                data: {"menu":menu},
                success: function(res) {
                    console.log("res");
                    console.log(res)
                    if (res!=="no change") {
                         location.reload();
                    }
                    // confirmation()
                    //location.reload();
                },
                error: function(er) {
                    console.log(er);
                }
            })
    }

    function confirmation() {
	var answer = confirm("Reposition Menu?")
	if (answer){
		alert("Bye bye!")
		location.reload();
	}
	else{
		alert("Ok, You can reposition menu on this page")
	}
}
</script>


<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
