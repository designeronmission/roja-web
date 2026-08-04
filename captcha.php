<!DOCTYPE html>
<html>
<head>
  <title>Invisible reCAPTCHA v3 Test</title>
  <script src="https://www.google.com/recaptcha/api.js?render=6Ldj4T4sAAAAAIQSee0NEYh8CuJQG6VVw78wo9et"></script>
</head>
<body>

<button id="testBtn">Test Invisible Captcha</button>

<pre id="output">Waiting...</pre>

<script>
document.getElementById("testBtn").addEventListener("click", function () {

  grecaptcha.ready(function () {
    grecaptcha.execute('6Ldj4T4sAAAAAIQSee0NEYh8CuJQG6VVw78wo9et', { action: 'invisible_test' })
      .then(function (token) {

        fetch("cpatcha_verify.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "recaptcha_token=" + token
        })
        .then(res => res.json())
        .then(data => {
          document.getElementById("output").textContent =
            JSON.stringify(data, null, 2);
        });

      });
  });

});
</script>

</body>
</html>