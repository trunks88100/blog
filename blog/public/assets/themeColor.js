 
 function themeColor(color_id){
            document.cookie = `theme=${color_id};path=/;max-age=31536000`;
            document.documentElement.dataset.theme = color_id;
    }
function getCookie(name) {
    return document.cookie.split('; ')
        .find(row => row.startsWith(name + '='))
        ?.split('=')[1];
}
function applyTheme(){
        let color = getCookie('theme');
        if(color){
            document.documentElement.dataset.theme = color;
        }
    }

window.addEventListener('DOMContentLoaded', applyTheme);

