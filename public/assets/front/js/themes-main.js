
$(document).ready(function(){

    $(document).on('change','.languageChange',function(e){
        e.preventDefault();
        const that  = $(this);
        const url = that.val()
        return location.href = url;
    });
    
    
    });