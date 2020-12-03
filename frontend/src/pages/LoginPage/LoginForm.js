import React, { useState } from "react";
import { useForm } from "react-hook-form";
import "./page.scss";
import { MdBusinessCenter, MdFace, MdPerson, MdLock } from "react-icons/md";
import FormInput from "../../components/forms/FormInput";

export default function LoginForm() {
  const [isStudent, setIsStudent] = useState(true);

  const {
    register,
    handleSubmit,
    errors,
    setError,
    reset,
    clearErrors,
  } = useForm();

  const onSubmit = (data, e) => {
    e.preventDefault();
    console.log(data);
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
      />
      <FormInput
        type="password"
        name="password"
        required={true}
        reference={register}
        placeholder="Hasło"
        icon={<MdLock />}
      />
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
