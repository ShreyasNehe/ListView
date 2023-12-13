<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>PHP CRUD Application</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      PHP ADD NEW Row
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="insert_row.php" method="post" style="width:50vw; min-width:300px;">

            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">InvoiceId</label>
                  <input type="number" id="invoiceId" name="invoiceId" placeholder="Enter invoice ID">
               </div>

               <div class="col">
                  <label class="form-label">Status</label>
                  <input type="text" id="status" name="status" placeholder="Enter status">
               </div>
            </div>

            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Company</label>
                  <input type="text" id="company" name="company" placeholder="Enter company name">
               </div>

               <div class="col">
                  <label class="form-label">Location</label>
                  <input type="text" id="location" name="location" placeholder="Enter location">
               </div>
            </div>

            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">DueDate</label>
                  <input type="date" id="dueDate" name="dueDate">
               </div>

               <div class="col">
                  <label class="form-label">LastConnected</label>
                  <input type="datetime-local" id="lastConnected" name="lastConnected">
               </div>

               <div class="col">
                  <label class="form-label">Currency</label>
                  <input type="text" id="currency" name="currency" placeholder="Enter currency">
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Amount</label>
               <input type="number" id="amount" name="amount" placeholder="Enter amount">
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
