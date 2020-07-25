$(document).ready(function () {
    $("button").click(function () {
        let clipboard = new ClipboardJS('.btn');
        let longUrl = $("#longUrl").val();

        $.post("short_url.php",
            {
                longUrl: longUrl
            },
            function (data) {
                let obj = jQuery.parseJSON(data);
                
                if(obj.error){
                    
                    alert(obj.error.msg);
                    $(".shortDiv").remove();

                }else if($(".shortDiv").length){
                
                    $(".shortDiv").remove();
                    $("#header").append("<div class='shortDiv col-md-8  d-flex flex-column justify-content-start align-items-center'><div class='col-md-11 pt-3 d-flex justify-content-center align-items-baseline'><input type='text' class='short col-md-7' value="+ obj.res +"><button class='btn btn-secondary ml-4' data-clipboard-target='.short'>Copy</button></div><div class='col-md-11 pt-3 d-flex justify-content-center align-items-baseline'><input type='text' class='shortHits col-md-7' value=''><button class='btn btn-secondary ml-4 hits'>Hits</button></div></div>");
                
                }else{

                    $("#header").append("<div class='shortDiv col-md-8  d-flex flex-column justify-content-start align-items-center'><div class='col-md-11 pt-3 d-flex justify-content-center align-items-baseline'><input type='text' class='short col-md-7' value="+ obj.res +"><button class='btn btn-secondary ml-4' data-clipboard-target='.short'>Copy</button></div><div class='col-md-11 pt-3 d-flex justify-content-center align-items-baseline'><input type='text' class='shortHits col-md-7' value=''><button class='btn btn-secondary ml-4 hits'>Hits</button></div></div>");
                
                }
                
            })
    });

    $("#header").on('click', '.hits', function(){ 
        let url = $(".short").val();
        let code = url.substring(26);
        
        //alert(code);
        
        $.post("hits.php",
            {
                shortCode: code
            },
            function (data) {
                let obj = jQuery.parseJSON(data);
                
                if(obj.error){
                    
                    alert(obj.error.msg);

                }else{
                    
                    $(".shortHits").val(obj.res);
                }
                
            })
   });

});




