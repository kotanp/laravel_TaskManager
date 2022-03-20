class Ajax{
    constructor(token){this.token=token;}   

    getAjax(apivegpont, tomb, callback){   
        $.ajax({url: apivegpont, type: "GET",success: function(result){
            tomb.splice(0,tomb.length);
            result.forEach(element => {
                tomb.push(element);
            });
            callback(tomb);
            },error: function (data, textStatus, errorThrown) {
                console.log(data);
        
            },
        });
    }

    getAjax2(apivegpont, callback){   
        $.ajax({url: apivegpont, type: "GET",success: function(result){
            callback(result);
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
            error: function (data, textStatus, errorThrown) {
                console.log(data);
        
            },
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

    fetchAjax(apivegpont, ujAdat){
        fetch(apivegpont, {
            method: "POST",
            
            body: JSON.stringify(ujAdat),
            headers: {
                'X-CSRF-TOKEN': this.token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }).then(response => {
            if(!response.ok) {
                return response.json().then(text => { 
                    if(text.errors.oldpwd){
                        let err = new Error(text.errors.oldpwd);
                        err.name = 'oldpwd';
                        //throw new Error(text.errors.oldpwd);
                        throw err;
                    }
                    else if(text.errors.newpwd){
                        //throw new Error(text.errors.newpwd);
                        let err = new Error(text.errors.newpwd);
                        err.name = 'newpwd';
                        //throw new Error(text.errors.oldpwd);
                        throw err;
                    }
                    else{
                        //throw new Error(text.errors.confirmpwd);
                        let err = new Error(text.errors.confirmpwd);
                        err.name = 'confirmpwd';
                        //throw new Error(text.errors.oldpwd);
                        throw err;
                    }
                    
                });
            }
            else {
                return response.json();
            }    
        }).catch(error => {
            console.log(error);
            if(error.name == 'oldpwd'){
                $('#newpwderror').empty();
                $('#confirmpwderror').empty();
                $('#oldpwderror').text(error.message);
            }else if(error.name == 'newpwd'){
                $('#oldpwderror').empty();
                $('#confirmpwderror').empty();
                $('#newpwderror').text(error.message);
            }else if(error.name == 'confirmpwd'){
                $('#oldpwderror').empty();
                $('#newpwderror').empty();
                $('#confirmpwderror').text(error.message);
            }
            
        });
    }
}