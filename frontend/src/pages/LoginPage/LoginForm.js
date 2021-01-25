import React, { useState } from "react";
import { useForm } from "react-hook-form";
import "./page.scss";
import { MdBusinessCenter, MdFace, MdPerson, MdLock } from "react-icons/md";
import FormInput from "../../components/forms/FormInput";

import { login } from "../../actions/auth";
import AuthService from "../../services/auth.service";
import { useDispatch } from "react-redux";

export default function LoginForm() {
  const [isStudent, setIsStudent] = useState(true);
  const dispatch = useDispatch();

  const {
    register,
    handleSubmit,
    errors,
    setError,
    reset,
    clearErrors,
  } = useForm();

  const onSubmit = async (data, e) => {
    e.preventDefault();

    let status = "";
    if (data.isStudent) {
      status = "student";
    } else {
      status = "educator";
    }

    const response = await AuthService.login(data.id, data.password, status)
      .then((response) => {
        dispatch(login(response.access_token));
        window.location.replace(`/${status}`);
      })
      .catch((err) => {
        console.log("err");
        setError("serverError", "err");
      });
  };

  const handleChange = () => {
    clearErrors();
  };

  return (
    <form
      className="login-form"
      onSubmit={handleSubmit((data, e) => onSubmit(data, e))}
    >
      <FormInput
        type="text"
        name="id"
        required={true}
        reference={register}
        placeholder="Identyfikator"
        icon={<MdPerson />}
        handleChange={handleChange}
      />
      <FormInput
        type="password"
        name="password"
        required={true}
        reference={register}
        placeholder="Hasło"
        icon={<MdLock />}
        handleChange={handleChange}
      />
      {errors.serverError && (
        <p className="error">
          Podano niepoprawny indeks, lub hasło. <br /> Spróbuj jeszcze raz.
        </p>
      )}
      <br />
      <input type="submit" className="button primary" value="Zaloguj się" />
      <p className="form-loginas__title">Zaloguj się jako:</p>
      <div className="form-loginas">
        <label className="form-loginas__element">
          <input
            name="isStudent"
            type="checkbox"
            checked={isStudent}
            ref={register}
            onChange={() => setIsStudent(!isStudent)}
          />
          <MdFace />
          <p>Student/ Doktorant</p>
        </label>
        <label className="form-loginas__element">
          <input
            name="isTeacher"
            type="checkbox"
            checked={!isStudent}
            ref={register}
            onChange={() => setIsStudent(!isStudent)}
          />
          <MdBusinessCenter />
          <p>Dydaktyk</p>
        </label>
      </div>
    </form>
  );
}
