</div>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
        document.querySelectorAll('.pages').forEach(
        link=>{
            // console.log(link.href, window.location.href);
            if(link.href===window.location.href){
                link.setAttribute('aria-current', 'page');
                // console.log("current");
            }
    }
)
    </script>
</body>
</html>