class Ajax{
    constructor(token){this.token=token;}   

    getAjax(apivegpont, tomb, callback){
        tomb.splice(0,tomb.length);
        $.ajax({url: apivegpont, type: "GET",success: function(result){
            result.forEach(element => {
                console.log(element);
                tomb.push(element);
            });
            callback(tomb);
            },error: function (data, textStatus, errorThrown) {
                console.log(data);
        
            },
        });
    }

    postAjax(apivegpont, ujAdat){
        $.ajax({
            headers: {'X-CSRF-TOKEN': this.token},
            url: apivegpont, 
            type: "POST", 
            data:ujAdat,
            // error: function (data, textStatus, errorThrown) {
            //     console.log(data);
        
            // },
        });
    }
    
    postRedirectAjax(apivegpont, ujAdat){
        $.ajax({
            headers: {'X-CSRF-TOKEN': this.token},
            url: apivegpont, 
            type: "POST", 
            data:ujAdat,
            success: function(result){
                //console.log(result.url);
                location.assign(result.url);
            },
            // error: function (data, textStatus, errorThrown) {
            //     console.log(data);
            
            // },
        });
    }

    deleteAjax(apivegpont, id){
        $.ajax({
            headers: {'X-CSRF-TOKEN': this.token},
            url: apivegpont+"/"+id, 
            type: "DELETE",
        });
    }

    putAjax(apivegpont, id, ujAdat){
        $.ajax({
            headers: {'X-CSRF-TOKEN': this.token},
            url: apivegpont+"/"+id, 
            type: "PUT",
            data:ujAdat,
        });
    }
}