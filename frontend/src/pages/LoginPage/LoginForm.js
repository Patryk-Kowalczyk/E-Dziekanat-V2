import React from "react";
import { useForm } from "react-hook-form";
import "./page.scss";

export default function LoginForm() {
  const {
    register,
    handleSubmit,
    errors,
    setError,
    reset,
    clearErrors,
  } = useForm();

  return (
    <form className="login-form">
      <div className="form-input">
        <input
          type="text"
          name="id"
          required={true}
          ref={register}
          placeholder="Identyfikator"
        />
        <label>Identyfikator</label>
      </div>
      <div className="form-input">
        <input
          type="password"
          name="password"
          required={true}
          ref={register}
          placeholder="Hasło"
        />
        <label>Hasło</label>
      </div>
      <input type="submit" className="button primary" value="Zaloguj się" />
      <br />
      Zaloguj się jako:
      <br />
      <label>
        <input type="checkbox" />
        Student
      </label>
      <label>
        <input type="checkbox" />
        Dydaktyk
      </label>
    </form>
  );
}
