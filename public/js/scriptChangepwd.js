$(function() {
    const token=$('meta[name="csrf-token"]').attr('content');
    const ajax=new Ajax(token);
    let errorTomb=[];
    let error = "http://localhost:8000/api/error";
    let url = "http://localhost:8000/change";
    //ajax.getAjax2(error, errorLista);

    function errorLista(errors) {
        const szuloElem = $("#oldpwderror");
        szuloElem.empty();
        if(errors.oldpwd){
            $("#oldpwderror").text(errors.oldpwd);
        }
    }

    $("#submit").on("click",(event)=>{
        event.preventDefault();
        let oldpwd=$("#oldpwd").val();
        let newpwd=$("#newpwd").val();
        let confirmpwd=$("#confirmpwd").val();
        let ujAdat={
            oldpwd:oldpwd,
            newpwd:newpwd,
            confirmpwd:confirmpwd,
        };
        ajax.fetchAjax(url, ujAdat);
    });
})