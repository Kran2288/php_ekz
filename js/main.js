let params = window
    .location
    .search
    .replace('?','')
    .split('&')
    .reduce(
        function(p,e){
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );
if(params['error']){
    let error = JSON.parse(params['error']);
    let print_text = '';
    $.each(error, function (index, value) {
        print_text += value + '<br>';
    });
    swal("Ошибка!", print_text, "error");
}
