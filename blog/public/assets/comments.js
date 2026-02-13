 const comments = document.getElementById('comments');

    function showComments(id){
        comments.classList.add('comments_show');

        const postComments = document.querySelectorAll('.comments_content')
        postComments.forEach((comment, index)=>{
                post_id = comment.innerHTML.split('none">')
                post_id = post_id[1].split('</span>')
                post_id = post_id[0];

                if(post_id.match(`^${id}$`)){
                    comment.style.display="block";
                } else {
                    comment.style.display="none";
                }
            })
        } 
        
        
    function closeComments(){
        comments.classList.remove('comments_show');

        document.querySelectorAll('input[type="radio"]').forEach((radio)=>{
            radio.checked= false;
        })
    }

    



    const textarea = document.getElementById('comment_text');

    textarea.addEventListener('input', () => {
    textarea.style.height = textarea.scrollHeight + 'px';
    });

    function toggle_show(el){
        const window = document.getElementById(el);
        window.classList.toggle('show');
    }

    function add_hide(el){
        const window = document.getElementById(el);
        window.classList.add('hide');
    }
    function remove_hide(el){
        const window = document.getElementById(el);
        window.classList.remove('hide');
    }


    function passPostId(id){
        document.getElementById('post_id').value = id;
    }
