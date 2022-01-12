$(document).ready(function(){
    $(".cboKhoa").change(function(){
        var namhoc = $(".cboKhoa").val();
        $.post("loadNamHoc.php", {namhoc: namhoc}, function(data){
            $(".cboNamHoc").html(data);
        })
    })
})