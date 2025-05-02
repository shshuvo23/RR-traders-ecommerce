

<script>
//PHOTO CROPING
$(document).ready(function(){

    @if(isMobile())
    var boundaryWidth = 380;
    @else
    var boundaryWidth = 600;
    @endif
    var boundaryHeight = boundaryWidth / 1;
    var viewportWidth = boundaryWidth - (boundaryWidth/100*25);
    var viewportHeight = boundaryHeight - (boundaryHeight/100*25);
    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: viewportWidth, height: viewportHeight,
            type:'square' //circle
        },
        boundary:{
            width: boundaryWidth, height: boundaryHeight
        },
        enableOrientation: true,
    });

    $cover_crop = $('#cover_demo').croppie({
        enableExif: true,
        showZoomer: true,
        viewport: {
            width: 480, height: 200,
            type:'square' //circle
        },
        boundary:{
            width: boundaryWidth, height: boundaryHeight
        },
        enableOrientation: true,
    });
});


$(document).on('click', '#upload_image', function(){
    $(this).val('');
    $(this).trigger('change');
});

$(document).on('change', '#upload_image', function(){
var reader = new FileReader();
reader.onload = function (event) {
    $image_crop.croppie('bind', {
        url: event.target.result
    }).then(function(){
        console.log('jQuery bind complete');
    });
}
reader.readAsDataURL(this.files[0]);
$('#uploadimageModal').modal('show');
});

 $(document).on('click', '.crop_image', function(event){
    var upload_image_url = $('#upload_image_url').val();
    var _this = this;
    console.log(this);
    $image_crop.croppie('result', {
        type: 'canvas',
        size: { width: 600, height: 600 }
    }).then(function(response){
        $.ajax({
            url: upload_image_url,
            type: "POST",
            beforeSend: function () {
                $("body").css("cursor", "progress");
                // $(_this).children(".loading-spinner").toggleClass('active');
                $(_this).attr("disabled", true);
                // $(_this).children(".btn-txt").text("Croping & Uploading image");
            },
            data:{
                "image": response,
                "_token": "{{ csrf_token() }}",
            },
            success:function(data)
            {
                $(_this).attr("disabled", false);
                // $(_this).children(".loading-spinner").removeClass('active');
                // $(_this).children(".btn-txt").text("Crop & Upload image");
                $('#uploadimageModal').modal('hide');
                $('#preview_profile').html(data.path);
                $('#profile_image_path').val(data.input);
                $('#upload_image').val(1);

            },
            error: function (jqXHR, exception) {
                $(_this).attr("disabled", false);
                // $(_this).children(".loading-spinner").removeClass('active');
                // $(_this).children(".btn-txt").text("Crop & Upload image");
                toastr.error('Something wrong ! Please try again');
            },
            complete: function (response) {
                $(_this).attr("disabled", false);
                // $(_this).children(".btn-txt").text("Crop & Upload image");
                // $(_this).children(".loading-spinner").removeClass('active');
                $("body").css("cursor", "default");

            }
        });
    })
 });


$(document).on('click', '#upload_cover', function(){
    $(this).val('');
    $(this).trigger('change');
});

$(document).on('change', '#upload_cover', function(){
var reader_cover = new FileReader();
reader_cover.onload = function (event) {
    $cover_crop.croppie('bind', {
        url: event.target.result
    }).then(function(){
        console.log('jQuery bind complete');
    });
}
reader_cover.readAsDataURL(this.files[0]);
$('#uploadcoverModal').modal('show');
});

$(document).on('click', '.crop_cover', function(event){

    var upload_cover_url = $('#upload_cover_url').val();

    var _this = this;
    $cover_crop.croppie('result', {
        type: 'canvas',
        size: { width: 480, height: 200 }
    }).then(function(response){
        $.ajax({
            url: upload_cover_url,
            type: "POST",
            beforeSend: function () {
                $("body").css("cursor", "progress");
                // $(_this).children(".loading-spinner").toggleClass('active');
                $(_this).attr("disabled", true);
                // $(_this).children(".btn-txt").text("Croping & Uploading image");
            },
            data:{
                "image": response,
                "_token": "{{ csrf_token() }}",
            },
            success:function(data)
            {
                $(_this).attr("disabled", false);
                // $(_this).children(".loading-spinner").removeClass('active');
                // $(_this).children(".btn-txt").text("Crop & Upload image");
                $('#uploadcoverModal').modal('hide');
                $('.banner').css('background-image', 'url(' + data.path + ')');
                $('#cover_image_path').val(data.input);
                $('#upload_cover').val(1);

            },
            error: function (jqXHR, exception) {
                $(_this).attr("disabled", false);
                // $(_this).children(".loading-spinner").removeClass('active');
                // $(_this).children(".btn-txt").text("Crop & Upload image");
                toastr.error('Something wrong ! Please try again');
            },
            complete: function (response) {
                $(_this).attr("disabled", false);
                // $(_this).children(".btn-txt").text("Crop & Upload image");
                // $(_this).children(".loading-spinner").removeClass('active');
                $("body").css("cursor", "default");

            }
        });
    })
});


</script>
