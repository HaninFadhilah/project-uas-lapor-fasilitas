package com.nim2411500033.laporfas.model

data class LoginResponse(
    val success: Boolean,
    val message: String,
    val admin: Admin?
)
