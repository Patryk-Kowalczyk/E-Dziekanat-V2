import React, {useState} from 'react';

const Form = ({element}) => {
    const [isOpenForm, setOpenForm] = useState(false);
    const [formMarks, formMarksUpdate] = useState(element.marks);

    return (
        <>
            <div key={element.unique_number} className="nameLastName" onClick={() => setOpenForm(!isOpenForm)}>
                {element.first_name + " " + element.last_name}
            </div>
            {isOpenForm && (
                <div className="marksForm">
                    <form>
                        {formMarks.map((e, i) => {
                            return (
                                // <div style={{paddingLeft: "10px"}} className="mark" key={e.id}>
                                //     <div className="mark2">{e.mark}</div>
                                // </div>
                                <>
                                    <div>
                                        <input className="inputForm" type="text" value={e.description}/>
                                        <input className="inputForm" type="text" value={e.mark}/>
                                        <br/>
                                    </div>
                                </>
                            )
                        })}
                        <button className="buttonForm">Submit</button>
                    </form>
                </div>
            )}
        </>
    );
};

export default Form;
