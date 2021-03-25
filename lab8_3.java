import java.awt.*;
import java.awt.event.*;

import javax.swing.*;

public class lab8_3 extends JFrame implements ActionListener{
    JLabel textLabel;
    JTextField textField;
    JButton saveBtn, clearBtn, showBtn;
    JButton addBtn, subBtn, mulBtn, divBtn, sqrBtn, pcBtn, invtBtn, hexBtn, powBtn;
    Container container;
    NumberNew obj;

    public lab8_3(){
        super("Program Calculate Number");
        Font font = new Font("Courier New",Font.BOLD,20);
        container = getContentPane();
        container.setLayout( new FlowLayout() );

        textLabel = new JLabel("Enter number :");
        textLabel.setFont(font);
        container.add( textLabel );

        textField = new JTextField( 10 );
        textField.setFont(new Font("Courier New",Font.BOLD,24));
        container.add( textField );

        saveBtn = new JButton("Save");
        saveBtn.setFont(new Font("Courier New",Font.BOLD,20));
        saveBtn.addActionListener( this);
        container.add( saveBtn );

        clearBtn = new JButton("Clear");
        clearBtn.setFont(new Font("Courier New",Font.BOLD,20));
        clearBtn.addActionListener( this);
        container.add( clearBtn );

        showBtn = new JButton("Show");
        showBtn.setFont(new Font("Courier New",Font.BOLD,20));
        showBtn.addActionListener( this);
        container.add( showBtn );

        addBtn = new JButton(" + ");
        addBtn.setFont(new Font("Courier New",Font.BOLD,20));
        addBtn.addActionListener( this);
        container.add( addBtn );

        subBtn = new JButton(" - ");
        subBtn.setFont(new Font("Courier New",Font.BOLD,20));
        subBtn.addActionListener( this);
        container.add( subBtn );

        mulBtn = new JButton(" * ");
        mulBtn.setFont(new Font("Courier New",Font.BOLD,20));
        mulBtn.addActionListener( this);
        container.add( mulBtn );

        divBtn = new JButton(" / ");
        divBtn.setFont(new Font("Courier New",Font.BOLD,20));
        divBtn.addActionListener( this);
        container.add( divBtn );

        sqrBtn = new JButton(" √ ");
        sqrBtn.setFont(new Font("Courier New",Font.BOLD,20));
        sqrBtn.addActionListener( this);
        container.add( sqrBtn );

        pcBtn = new JButton(" % ");
        pcBtn.setFont(new Font("Courier New",Font.BOLD,20));
        pcBtn.addActionListener( this);
        container.add( pcBtn );

        invtBtn = new JButton(" +/- ");
        invtBtn.setFont(new Font("Courier New",Font.BOLD,20));
        invtBtn.addActionListener( this);
        container.add( invtBtn );

        hexBtn = new JButton(" Hex ");
        hexBtn.setFont(new Font("Courier New",Font.BOLD,20));
        hexBtn.addActionListener( this);
        container.add( hexBtn );

        powBtn = new JButton(" 10^x ");
        powBtn.setFont(new Font("Courier New",Font.BOLD,20));
        powBtn.addActionListener( this);
        container.add( powBtn );

        setSize(340,240);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setVisible(true);
    }

    public static void main(String[] args) {
        lab8_3 test = new lab8_3();
        test.obj = new NumberNew();
        test.textField.setText(test.obj.toString());
    }

    @Override
    public void actionPerformed(ActionEvent event) {
        if (event.getSource() == saveBtn) {
            if(textField.getText().isEmpty()){
                obj.setValue(0);
            }
            else{
                double value = Double.parseDouble(textField.getText());
                obj.setValue(value);
                textField.setText("");
            }
        }
        else if (event.getSource() == clearBtn) {
            obj.setValue( 0 );
            textField.setText("");
        }
        else if (event.getSource() == showBtn) {
            textField.setText(obj.toString());
        }
        else if (event.getSource() == addBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                obj.add(value);
                textField.setText(obj.toString());
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
        else if (event.getSource() == subBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                obj.subtract(value);
                textField.setText(obj.toString());
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
        else if (event.getSource() == mulBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                obj.multiply(value);
                textField.setText(obj.toString());
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
        else if (event.getSource() == divBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                obj.divide(value);
                textField.setText(obj.toString());
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
        else if (event.getSource() == sqrBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                obj.square(value);
                textField.setText(obj.toString());
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
        else if (event.getSource() == pcBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                obj.percent(value);
                textField.setText(obj.toString());
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
        else if (event.getSource() == invtBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                obj.invert(value);
                textField.setText(obj.toString());
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
        else if (event.getSource() == hexBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                textField.setText(obj.toHex(value));
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
        else if (event.getSource() == powBtn) {
            if(!textField.getText().isEmpty()){
                double value = Double.parseDouble(textField.getText());
                obj.pow(value);
                textField.setText(obj.toString());
            }
            else {
                JOptionPane.showMessageDialog(null, "Please Input number", "Empty",0);
            }
        }
    }
}
