import React, { Component } from 'react';
import NodeTriggerActionType from './NodeTriggerActionType';
import NodeTriggerArgumentTemplate from './NodeTriggerArgumentTemplate';

class NodeTriggerActionProgress extends Component {

    constructor(props) {
        super(props);
        this.changeType = this.changeType.bind(this);
        this.removeAction = this.removeAction.bind(this);
        this.onchangeAttr = this.onchangeAttr.bind(this);
    }

    changeType(e) {
        this.props.onChangeType({id : this.props.id, 'type' : e.target.value});
    }

    removeAction() {
        this.props.removeAction({id : this.props.id});
    }

    onchangeAttr(e) {
        this.props.onChangeContent({id : this.props.id, 'path' : ['content'].concat(e.path), value : e.value});
    }

    render() {
        return (
            <div>
                <div className="d-flex flex-row">
                    <div>
                        <div className="btn-group float-left" role="group" aria-label="Trigger actions">
                            <button disabled="disabled" className="btn btn-sm btn-info">{this.props.id + 1}</button>
                            {this.props.isFirst == false && <button className="btn btn-secondary btn-sm" onClick={(e) => this.props.upField(this.props.id)}><i className="material-icons mr-0">keyboard_arrow_up</i></button>}
                            {this.props.isLast == false && <button className="btn btn-secondary btn-sm" onClick={(e) => this.props.downField(this.props.id)}><i className="material-icons mr-0">keyboard_arrow_down</i></button>}
                        </div>
                    </div>
                    <div className="flex-grow-1 px-2">
                        <NodeTriggerActionType onChange={this.changeType} type={this.props.action.get('type')} />
                    </div>
                    <div className="pr-2">
                        <div className="input-group input-group-sm">
                            <div className="input-group-prepend">
                                <span className="input-group-text" id="basic-addon1"><span className="material-icons">vpn_key</span></span>
                            </div>
                            <input type="text" className="form-control" readOnly="true" value={this.props.action.getIn(['_id'])} title="Action ID"/>
                        </div>
                    </div>
                    <div className="pr-2 pt-1 text-nowrap">
                        <label className="form-check-label" title="Response will not be executed. Usefull for a quick testing."><input onChange={(e) => this.props.onChangeContent({id : this.props.id, 'path' : ['skip_resp'], value : e.target.checked})} defaultChecked={this.props.action.getIn(['skip_resp'])} type="checkbox"/> Skip</label>
                    </div>
                    <div>
                        <button onClick={this.removeAction} type="button" className="btn btn-danger btn-sm float-right">
                            <i className="material-icons mr-0">delete</i>
                        </button>
                    </div>
                </div>
                
                <div className="row">
                    <div className="col-6">
                        <div className="form-group">
                            <label>Update interval</label>
                            <input type="text" placeholder="Value in seconds" className="form-control" onChange={(e) => this.onchangeAttr({'path' : ['interval'], 'value' : e.target.value})} defaultValue={this.props.action.getIn(['content','interval'])}/>
                        </div>
                    </div>
                    <div className="col-6">
                        <div className="form-group">
                            <label>Event identifier</label>
                            <input placeholder="progress_event" type="text" className="form-control" onChange={(e) => this.onchangeAttr({'path' : ['method'], 'value' : e.target.value})} defaultValue={this.props.action.getIn(['content','method'])}/>
                        </div>
                    </div>
                </div>

                <div className="form-group">
                    <label>Argument template</label>
                    <NodeTriggerArgumentTemplate showOptional={true} onChange={this.onchangeAttr} argument={this.props.action.getIn(['content','argument_template'])} />
                </div>
                <hr className="hr-big" />

            </div>
        );
    }
}

export default NodeTriggerActionProgress;
