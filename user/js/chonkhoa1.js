$(document).ready(function(){
    $(".cboKhoa_1").change(function(){
        var khoa = $(".cboKhoa_1").val();
        $.post("loadLop.php", {khoa: khoa}, function(data){
            $(".cboLop_1").html(data);
        })
    })
})