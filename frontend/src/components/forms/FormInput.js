import React from "react";
import PropTypes from "prop-types";
import "./form-input.scss";

function FormInput(props) {
  return (
    <div className="form-input">
      <input
        type={props.type}
        name={props.name}
        required={props.required}
        ref={props.reference}
        placeholder={props.placeholder}
      />
      {props.icon}
      <label>{props.placeholder}</label>
    </div>
  );
}

FormInput.propTypes = {
  type: PropTypes.string,
  name: PropTypes.string,
  required: PropTypes.bool,
  reference: PropTypes.func,
  icon: PropTypes.node,
  placeholder: PropTypes.string,
};

export default FormInput;
