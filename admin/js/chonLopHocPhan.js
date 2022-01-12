$(document).ready(function(){
    $(".dropMaLopHocPhan").change(function(){
        var LopHocPhan = $(".dropMaLopHocPhan").val();
        $.post("loadSVLopHocPhan.php", {LopHocPhan: LopHocPhan}, function(data){
            $(".dropMaSinhVien").html(data);
        })
    })
})