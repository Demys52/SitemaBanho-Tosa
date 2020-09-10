$(document).ready(function(){
        if (screen.width < 640 || screen.height < 480)
        {
            $("table").removeClass("table table-bordered");
            $("table").addClass("table table-sm");
        }
        else
        {
            $("table").addClass("table table-bordered");
        }
    });