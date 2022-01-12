$(document).ready(function(){
    $(".cboKhoa_2").change(function(){
        var khoa = $(".cboKhoa_2").val();
        $.post("loadLop.php", {khoa: khoa}, function(data){
            $(".cboLop_2").html(data);
        })
    })
})