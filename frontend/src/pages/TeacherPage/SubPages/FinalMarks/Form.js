import React, {useState} from 'react';

const Form = ({element}) => {

    return (
        <>
            <div key={element.unique_number} className="nameLastName">
                {element.first_name + " " + element.last_name}
            </div>
        </>
    );
};

export default Form;
