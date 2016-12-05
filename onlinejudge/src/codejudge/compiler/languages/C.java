/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Codejudge Compiler Server: Compiler for the C language
 */

package codejudge.compiler.languages;

import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;

import codejudge.compiler.TimedShell;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;

public class C extends Language {
	
	String file, contents, dir;
	int timeout;
	
	public C(String file, int timeout, String contents, String dir) {
		this.file = file;
		this.timeout = timeout;
		this.contents = contents;
		this.dir = dir;
	}
	public void compile(Language l) {
		try {  
                
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file)));// File handler for a new file called "solve.c"
			out.write(contents); // write the solution onto the file
			out.close();
			// create the compiler script
			out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/compile.bat")));// Batch file containing compiler script
			out.write("cd \"" + dir +"\"\n");// Location of working directory 
			out.write("gcc -lm " + file + " 2> err.txt"); // Command to compile the code. err.txt stores the compile time errors generated.
			out.close();
			Runtime r = Runtime.getRuntime(); 
                        // Create an object of Runtime class. Read more about this class and the gerRuntime() function from JAVA's documentation.
                        // Now, the object r can be used execute stuff directly on the operating system. (Similiar to how a process is executed by double clicking on it)
	
                        Process p = r.exec( dir + "\\compile.bat"); 
                        // Create an object of process class. Execute the compile.bat batch file using r.exec() [ More info in JAVA's documentation ]
			
                        p.waitFor();// The program waits till the batch file has been executed
                        
                        System.out.println("before timeshell");
			p = r.exec(dir + "\\compile.bat"); 
                        
                      // Compiler script has been executed twice for some reason.   
                      
                        
			TimedShell shell = new TimedShell(this, p, 3000); // Define an upper limit for the time taken by compilation
			shell.start();  //Functon of class TimedShell
			p.waitFor();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}
	
	public void execute(Language l) {
		try {
			// create the execution script
                      l.timedout = false;// timedout variable to indicate whether time limit has exceeded or not.
		      
                      
                      BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\run.bat")));// Batch file containing execution script
		      out.write("cd \"" + dir +"\"\n");
                        //can be shortened
                      BufferedWriter testCaseWriter = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\testcase.txt")));
                      /*
                      The file "in.txt" contains all the given test cases, separated by a delimited (here  - ";"). All of these testcases
                      need to be extracted, and then given as input to the code. Thus, the testcase.txt is a intermediate file that, at an instance,
                      contains one of the test cases.
                      
                      
                      */
                      file = file.replace(".c", ".exe");
                      BufferedReader in = new BufferedReader(new FileReader(dir+"\\in.txt"));
                      File file = new File(dir + "\\testcase.txt"); 
                  
                      String fileContent = in.readLine(); // Read the input.txt file which contains all testcases
                      
                      
                      int num = fileContent.length() - fileContent.replaceAll(";","").length(); //Find out the number of ";" present in input.txt
                      BufferedWriter testOut = new BufferedWriter(new FileWriter(file,false));
                      BufferedReader in1 = new BufferedReader(new FileReader(file));
     
                      String Output = "";
                      String line = "";
                      out.write("a.exe < testcase.txt > out.txt");// Command which indicates that the exe file formed as the result of succesful compilation
                      // should be given the testcase.txt as input, and the output should be stored in out.txt
                      
                      out.close();
     
                  // Run loop till the number of testcases present
                   while(num!=0)
                    {  
                        
                        
                        testOut = new BufferedWriter(new FileWriter(file,false));
                        
                        int firstOccur = fileContent.indexOf(";");// Find index of the first occurence of ";"
                        String testCase = fileContent.substring(0, firstOccur);// Extract the current test case
                        testOut.write(testCase); // Write the current test case to testcase.txt
                        testOut.close();
                        fileContent = fileContent.replaceAll(testCase+";",""); // Replace the current testcase which has been written onto testcase.txt, with ("")
                        num--; 
			Runtime r = Runtime.getRuntime();
			Process p = r.exec(dir + "\\run.bat");// Execute the run.bat file
                        
			//p.waitFor();
			//p = r.exec(dir + "\\run.bat"); // execute the script
                       // System.out.println("\ntimeout - " + l.timedout);
			TimedShell shell = new TimedShell(this, p, timeout); 
			shell.start();// Sleep a thread till the time specified in the program
                        
                        System.out.println("\ntimeout - " + l.timedout);
			
                        p.waitFor(); // Wait till execution gets over
                        BufferedReader readOutput = new BufferedReader(new FileReader(dir + "\\out.txt"));
                        //System.out.println("\ntimeout - " + l.timedout);
                        
                        
                        // Check if the timeout has happended or not. TimedShell class has more details
                        if(l.timedout){
                            Output = Output + "timeout;\n"; // Append timeout to the output file, and a ";" which separates the different test cases
                        }
                        else
                        {
                            
                        line = readOutput.readLine();      
                       System.out.println("read from here\n");
                       
                       /*
                       Read output.txt and append each line to variable "output". The outputs of all test cases will be accumulated in the output variable, with
                       each testcase separated by ";".
                       */
                        while(line!=null)
                       {
                           
                           Output = Output+line+"\n";
                           
                           line = readOutput.readLine();
                       } 
                        Output = Output + ";\n" ;
                       }
                       System.out.println("output -"+ Output);// To debug
                    
                       
             
		} 
                     //Output = Output+"\n";
                      Output = Output.substring(0, Output.length()-1);
                      System.out.println(Output);        
                      
                      BufferedWriter writeOutput = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\out.txt")));
                      // Write the accumulated output onto the out.txt file
                      writeOutput.write(Output);
                      writeOutput.close();
                     /* BufferedReader readOutput = new BufferedReader(new FileReader(dir + "\\out.txt"));
                        System.out.println(readOutput.readLine()); Debug*/
                }   
                  
                
                catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
                
        
                
	}
}
