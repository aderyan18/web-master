<div class="modal-body">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" class="form-control" id="password" name="password" required>

    </div>
    <div class="form-group">
        <label for="class">Class</label>
        <select class="form-control" id="role" name="role" required>
            <option value="" selected disabled hidden>Choose here</option>
            <option>administrator</option>
            <option>admin</option>
            <option>user</option>
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="tambah" class="btn btn-success">Tambah User</button>
</div>