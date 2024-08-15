var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){
    var btn_search = document.getElementById('btn_search');
    var form_search = document.getElementById('form_search');
    var category = document.getElementById('category');
    if(btn_search){
        btn_search.addEventListener('click', function(e){
            e.preventDefault();
            if(form_search.style.display === 'block'){
                form_search.style.display = 'none';
            }else{
                form_search.style.display = 'block';
            }
        });
    }
    if(route == "products_add"){
        setSubcategoriesToProducts();
    }
    if(route == "products_edit"){
        setSubcategoriesToProducts();
        var btn_product_file_image = document.getElementById('btn_product_file_image');
        var product_file_image = document.getElementById('product_file_image');
        btn_product_file_image.addEventListener('click', function(){
            product_file_image.click();
        }), false;
        product_file_image.addEventListener('change', function(){
            document.getElementById('form_product_gallery').submit();
        });
    }
    document.getElementsByClassName('lk-'+route)[0].classList.add('active');
    btn_delete = document.getElementsByClassName('btn-delete');
    for(i=0; i < btn_delete.length; i++){
        btn_delete[i].addEventListener('click', delete_object);
    }
    if(category){
        category.addEventListener('change', setSubcategoriesToProducts);
    }
});

$(document).ready(function(){
    editor_init('editor');
})

function editor_init(field){
    //CKEDITOR.plugins.addExternal('codesnipet', base+'/static/libs/ckeditor/plugins/codesnipet/', 'plugin.js' );
    CKEDITOR.replace(field, {
        //skin: 'moono',
        //extraPlugins: 'codesnipet,ajax,xml,textmatch,autocomplete,textwatcher,emoji,panelbutton,preview,wordcount',
        toolbar: [
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlike', 'Blockquote' ] },
            { name: 'document', items: [ 'CodeSnippet', 'EmojiPanel', 'Preview', 'Source' ] }
        ]
    });
}

function delete_object(e){
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/Personal_projects/hm/public/' + path + '/' + object + '/' + action;
    if(action == "delete"){
        ccalert({title: '¿Estás seguro de eliminar este elemento?', type: 'delete', msg: 'Recuerda que esta acción enviara este elemento a la papelera o puede que lo elimine de forma definitiva.', actions: JSON.stringify([{url: url, name: 'Si, eliminar' , type: 'danger' }])});
    }else{
        ccalert({title: '¿Deseas restaurar este elemento?', type: 'restore', msg: 'El elemento sera restaurado.', actions: JSON.stringify([{url: url, name: 'Si, restaurar' , type: 'info' }])});
    }
        /*
    var url = base + '/Personal_projects/hm/public/' + path + '/' + object + '/' + action;
    var title, text, icon;
    if(action == 'delete'){
        title = "¿Estás seguro de eliminar este elemento?";
        text = "Recuerda que esta acción enviara este elemento a la papelera o puede que lo elimine de forma definitiva.";
        icon = "warning";
    }
    if(action == 'restore'){
        title = "¿Quieres restaurar este elemento?";
        text = "Esta acción restaura el elemento y estará activo en el sistema.";
        icon = "info";
    }
    swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
      })
      .then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
    });*/
}

function setSubcategoriesToProducts(){
    var parent_id = category.value;
    var subcategory_actual = document.getElementById('subcategory_actual').value;
    select = document.getElementById('subcategory');
    select.innerHTML = "";
    var url = base +'/Personal_projects/hm/public'+'/admin/hm/api/load/subcategories/'+parent_id;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            data.forEach(function(element, index) {
                if(subcategory_actual == element.id){
                    select.innerHTML += "<option value=\""+element.id+"\" selected>"+element.name+"</option>";
                }else{
                    select.innerHTML += "<option value=\""+element.id+"\">"+element.name+"</option>";
                }
            });
        }
    }
}