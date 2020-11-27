import React, {Component} from 'react';
import ReactDOM from 'react-dom';

function Example() {
    return (
        <div>
            <div>Siema</div>
            <div>I'm an React component!</div>
        </div>
    );
}

export default Example;

if (document.getElementById('root')) {
    ReactDOM.render(<Example/>, document.getElementById('root'));
}
