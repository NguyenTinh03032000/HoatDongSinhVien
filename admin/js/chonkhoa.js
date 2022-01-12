$(document).ready(function(){
    $(".cboKhoa").change(function(){
        var khoa = $(".cboKhoa").val();
        $.post("loadLop.php", {khoa: khoa}, function(data){
            $(".cboLop").html(data);
        })
    })
})