<h1>Create an account</h1>

<form action="" method="post">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label>First name</label>
                <input type="text" name="firstName" class="form-control">
            </div>
        </div>

        <div class="col">
            <div class="mb-3">
                <label>Last name</label>
                <input type="text" name="lastName" class="form-control">
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        
        <div class="col">
            <div class="mb-3">
                <label>Confirm password</label>
                <input type="password" name="passwordConfirm" class="form-control">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="text" name="email" class="form-control">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>