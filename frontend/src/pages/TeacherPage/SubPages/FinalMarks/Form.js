import React, {useState} from 'react';
import Input from "../IndividualMarks/Input";

const Form = ({element}) => {
    const [isOpenForm, setOpenForm] = useState(false);
    const [formMark, formMarksUpdate] = useState(element.mark || null);
    const handleOnClick = (e) => {
        e.preventDefault()
        console.log(
            formMark, element.first_name, element.unique_number
        );
    }
    return (
        <>
            <div key={element.unique_number} className="nameLastName" onClick={() => setOpenForm(!isOpenForm)}>
                {element.first_name + " " + element.last_name}
            </div>
            {isOpenForm && (
                <div className="marksForm">
                    <form>
                        <label>Ocena końcowa:{" "}
                            <input type="text" className="inputForm"
                                   value={formMark}
                                   onChange={(e) => formMarksUpdate(e.target.value)}
                            />
                        </label>
                        <button onClick={handleOnClick} className="buttonForm">Submit</button>
                    </form>
                </div>
            )}
        </>
    );
};

export default Form;
