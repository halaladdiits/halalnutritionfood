//Form
var add_form_max = 10;
var add_form_wrapper = $(".input_fields_wrap");
var add_certificate = $(".add_certificate");
var add_source = $(".add_source");

var x = 1;
$(add_certificate).click(function (e) {
    e.preventDefault();
    if (x < add_form_max) {
        x++;
        $(add_form_wrapper).append('<div class="row"><div class="col-lg-3 col-md-4"><div class="form-group"><input class="form-control form-code" placeholder="Code" name="cCode[]" type="text"></div></div><div class="col-lg-2 col-md-3"><div class="form-group"><input class="form-control form-date" id="certexp" placeholder="dd-mm-yyyy" name="cExpire[]" type="text"></div></div><div class="col-lg-3 col-md-4"><div class="form-group"><select class="form-control select3" placeholder="Status" name="cStatus[]"><option value="0">Development</option><option value="1">New</option><option value="2">Renew</option></select></div></div><div class="col-lg-3 col-md-4 col-xs-11"><div class="form-group"><input class="halalcertorg form-control" placeholder="Halal Organization" autocomplete="off" name="cOrganization[]" type="text"></div></div><div class="col-lg-1 col-md-1 col-xs-1"><a href="#" class="btn btn-danger remove_field"><i class="fa fa-minus"></i></a></div></div>');
        $(".form-date").inputmask("dd-mm-yyyy",{ "placeholder": "dd-mm-yyyy" });
        $('.select3').select2({
            width: '100%',
            theme: "bootstrap",
        });
        $('.halalcertorg').typeahead({
            ajax: {
                url: laroute.route('api.certOrg.list'),
                triggerLength: 3
            }
        });
    }
});
$(add_source).click(function (e) {
    e.preventDefault();
    if (x < add_form_max) {
        x++;
        $(add_form_wrapper).append('<div class="col-lg-4 col-md-6 col-xs-12"><div class="col-md-12"><label for="halalSource">Halal Source</label></div><div class="col-md-12"><div class="form-group"><input class="hOrganization form-control" placeholder="Halal Organization" name="hOrganization[]" type="text" autocomplete="off"></div></div><div class="col-md-12"><div class="form-group"><select class=" select3 form-control" placeholder="Halal Status" name="hStatus[]"><option value="0">Halal</option><option value="1">Masbooh</option><option value="2">Haram</option></select></div></div><div class="col-md-12"><div class="form-group"><textarea class="form-control" placeholder="Enter description here" rows="10" cols="3" name="hDescription[]"></textarea></div></div><div class="col-lg-10 col-md-10 col-xs-10"><div class="form-group"><input class="url form-control" placeholder="Put URL here" name="url[]" type="text"></div></div><div class="col-md-1"><a href="#" class="btn btn-danger remove_field"><i class="fa fa-minus"></i></a></div></div>');
        $('.hOrganization').typeahead({
            ajax: {
                url: laroute.route('api.halalOrg.list'),
                triggerLength: 3
            }
        });
        $('.select3').select2({
            width: '100%',
            theme: "bootstrap",
        });
        $(".url").inputmask({alias: 'url', greedy: false});
    }
});
$(add_form_wrapper).on("click", ".remove_field", function (e) {
    e.preventDefault();
    $(this).parent('div').parent('div').remove();
    x--;
});
