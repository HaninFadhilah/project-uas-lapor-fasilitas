package com.nim2411500033.laporfas

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.nim2411500033.laporfas.api.ApiClient
import com.nim2411500033.laporfas.model.Admin
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class LoginActivity : AppCompatActivity() {

    private lateinit var etUsername: EditText
    private lateinit var etPassword: EditText
    private lateinit var btnLogin: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        etUsername = findViewById(R.id.etUsername)
        etPassword = findViewById(R.id.etPassword)
        btnLogin = findViewById(R.id.btnLogin)

        btnLogin.setOnClickListener {
            val username = etUsername.text.toString()
            val password = etPassword.text.toString()

            if(username.isEmpty() || password.isEmpty()){
                Toast.makeText(this, "Isi semua data", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            ApiClient.instance.login(username, password)
                .enqueue(object : Callback<Admin> {
                    override fun onResponse(call: Call<Admin>, response: Response<Admin>) {
                        val admin = response.body()
                        if (admin?.success == true) {
                            startActivity(Intent(this@LoginActivity, DashboardActivity::class.java))
                            finish()
                        } else {
                            Toast.makeText(this@LoginActivity, admin?.message ?: "Login gagal", Toast.LENGTH_SHORT).show()
                        }
                    }

                    override fun onFailure(call: Call<Admin>, t: Throwable) {
                        Toast.makeText(this@LoginActivity, t.message, Toast.LENGTH_LONG).show()
                    }
                })

        }
    }
}
