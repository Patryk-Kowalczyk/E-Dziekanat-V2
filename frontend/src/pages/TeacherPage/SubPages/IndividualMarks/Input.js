import React from 'react';

const Input = ({valueInput, valueI, handleOnChange}) => {

    return (
        <input className="inputForm"
               type="text"
               placeholder={valueI}
               value={valueInput}
               onChange={(e, index) => (
                   handleOnChange(e, index))
               }/>
    );
};

export default Input;
