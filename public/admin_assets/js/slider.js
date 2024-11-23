$("#show_btn").on("change",(el)=>{
    const isShowBtn = el.target.value || "NO";
    $(".button-group").removeClass('d-none')
    if(isShowBtn == "NO"){
        $(".button-group").addClass('d-none')
    }
})