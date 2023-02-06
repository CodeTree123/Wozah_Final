{{--@if(Session::has('success'))
    <div class="d-flex justify-content-between align-items-center alert alert-success alert-dismissible fade show test" role="alert" >
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@endif--}}
{{--@if(Session::has('fail'))
    <div class="d-flex justify-content-between align-items-center alert alert-success alert-dismissible fade show test" role="alert">
        {{Session::get('fail')}}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif--}}
<style>
.cus_toast{
    position: absolute;
    top: 80px;
    right: 30px;
    border-radius: 12px;
    background: #fff;
    padding: 20px 35px 20px 25px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    border-left: 6px solid #4070f4;
    overflow: hidden;
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
    z-index: 1;
}

.cus_toast.active{
    transform: translateX(0%);
}

.cus_toast .toast-content{
    display: flex;
    align-items: center;
}

.toast-content .check{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 35px;
    width: 35px;
    background-color: #4070f4;
    color: #fff;
    font-size: 20px;
    border-radius: 50%;
}

.toast-content .message{
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text{
    font-size: 15px;
    font-weight: 400;;
    color: #666666;
}

.message .text.text-1{
    font-weight: 600;
    color: #333;
}

.cus_toast .close{
    position: absolute;
    top: 10px;
    right: 15px;
    padding: 5px;
    cursor: pointer;
    opacity: 0.7;
}

.cus_toast .close:hover{
    opacity: 1;
}

.cus_toast .progress{
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    background: #ddd;
}

.cus_toast .progress:before{
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    height: 100%;
    width: 100%;
    background-color: #4070f4;
}

.progress.active:before{
    animation: progress 3s linear forwards;
}

@keyframes progress {
    100%{
        right: 100%;
    }
}

</style>

@if(Session::has('success'))
    <div class="cus_toast">
        <div class="toast-content">
            <i class="fas fa-solid fa-check check"></i>
            <!-- <i class="fas fa-solid fa-xmark check"></i> -->

            <div class="message">
                <span class="text text-1">Success</span>
                <span class="text text-2">{{Session::get('success')}}</span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close"></i>

        <div class="progress"></div>
    </div>
    <button class="cus_btn d-none"></button>
@endif

@if(Session::has('fail'))
    <div class="cus_toast">
        <div class="toast-content">
            <!-- <i class="fas fa-solid fa-check check"></i> -->
            <i class="fas fa-solid fa-xmark check"></i>

            <div class="message">
                <span class="text text-1">Fail</span>
                <span class="text text-2">{{Session::get('fail')}}</span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close"></i>

        <div class="progress"></div>
    </div>
    <button class="cus_btn d-none"></button>
@endif
