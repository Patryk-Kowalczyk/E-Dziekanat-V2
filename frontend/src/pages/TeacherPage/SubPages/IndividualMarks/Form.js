import React, {useState} from 'react';

const Form = ({element}) => {
    const [isOpenForm, setOpenForm] = useState(false);
    return (
        <>
            <div key={element.unique_number} className="nameLastName" onClick={() => setOpenForm(!isOpenForm)}>
                {element.first_name + " " + element.last_name}
            </div>
            {isOpenForm && (
                <div className="marksForm">
                    {"tekst"}
                </div>
            )}
        </>
    );
};

export default Form;
