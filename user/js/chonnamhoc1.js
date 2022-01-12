$(document).ready(function(){
    $(".cboKhoa_1").change(function(){
        var namhoc = $(".cboKhoa_1").val();
        $.post("loadNamHoc.php", {namhoc: namhoc}, function(data){
            $(".cboNamHoc_1").html(data);
        })
    })
})